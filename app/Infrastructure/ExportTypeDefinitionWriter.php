<?php

declare(strict_types=1);

namespace App\Infrastructure;

use Spatie\TypeScriptTransformer\Structures\TypesCollection;
use Spatie\TypeScriptTransformer\Writers\TypeDefinitionWriter;

final class ExportTypeDefinitionWriter extends TypeDefinitionWriter
{
    public function format(TypesCollection $collection): string
    {
        return str_replace('declare namespace ', 'export namespace ', parent::format($collection));
    }
}
