import { DataTable } from '../components';
import { ExtractComponentProps } from '@app/types/ExtractComponentProps';
import { VNode, defineComponent, h } from 'vue';

interface GenericProps<TItem extends object>
    extends Omit<ExtractComponentProps<typeof DataTable>, 'items'> {
    items: Array<TItem>;
}

type GenericSlots<TItem> = {
    item: Record<keyof TItem, (data: TItem) => VNode[]>;
};

export function useGenericDataTable<TItem extends object>() {
    const wrapper = defineComponent((props: GenericProps<TItem>, { slots }) => {
        return () => h(DataTable, props, slots);
    });

    return wrapper as typeof wrapper & {
        new (): {
            $slots: {
                actions: (data: GenericSlots<TItem>) => VNode[];
            } & Record<keyof TItem, (data: GenericSlots<TItem>) => VNode[]>;
        };
    };
}
