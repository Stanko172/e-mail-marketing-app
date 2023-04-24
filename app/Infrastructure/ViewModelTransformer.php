<?php

declare(strict_types=1);

namespace App\Infrastructure;

use Illuminate\Support\Str;
use ReflectionClass;
use ReflectionMethod;
use Spatie\TypeScriptTransformer\Structures\MissingSymbolsCollection;
use Spatie\TypeScriptTransformer\Structures\TransformedType;
use Spatie\TypeScriptTransformer\Transformers\Transformer;
use Spatie\TypeScriptTransformer\Transformers\TransformsTypes;
use Spatie\TypeScriptTransformer\TypeProcessors\DtoCollectionTypeProcessor;
use Spatie\TypeScriptTransformer\TypeProcessors\ReplaceDefaultsTypeProcessor;
use Spatie\TypeScriptTransformer\TypeScriptTransformerConfig;
use Spatie\ViewModels\ViewModel;

final class ViewModelTransformer implements Transformer
{
    use TransformsTypes;

    protected TypeScriptTransformerConfig $config;

    public function __construct(TypeScriptTransformerConfig $config)
    {
        $this->config = $config;
    }

    public function transform(ReflectionClass $class, string $name): ?TransformedType
    {
        if (! $class->isSubclassOf(ViewModel::class)) {
            return null;
        }

        $missingSymbols = new MissingSymbolsCollection();

        $type = implode([
            $this->transformMethods($class, $missingSymbols),
        ]);

        return TransformedType::create(
            $class,
            $name,
            '{' . PHP_EOL . $type . '}',
            $missingSymbols,
        );
    }

    private function transformMethods(ReflectionClass $class, MissingSymbolsCollection $missingSymbols): string
    {
        return array_reduce(
            $class->getMethods(ReflectionMethod::IS_PUBLIC),
            function (string $carry, ReflectionMethod $method) use ($class, $missingSymbols) {
                if (($method->class !== $class->name) || Str::startsWith($method->name, '__')) {
                    return $carry;
                }

                $returnType = 'any';

                if ($method->hasReturnType() || $method->getDocComment()) {
                    $returnType = $this->reflectionToTypeScript(
                        $method,
                        $missingSymbols,
                        ...$this->typeProcessors(),
                    );
                }

                return "{$carry}{$method->getName()}: {$returnType};" . PHP_EOL;
            },
            '',
        );
    }

    private function typeProcessors(): array
    {
        return [
            new ReplaceDefaultsTypeProcessor(
                $this->config->getDefaultTypeReplacements(),
            ),
            new DtoCollectionTypeProcessor(),
        ];
    }
}
