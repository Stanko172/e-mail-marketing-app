import { toast } from 'vue3-toastify';
import { usePage } from '@inertiajs/vue3';
import { ToastNotification } from '@app/types/custom';
import { computed, onMounted } from 'vue';

export function useToastNotifications() {
    const toastNotifications = computed<ToastNotification[]>(
        () => (usePage().props.toastNotifications as ToastNotification[]) || []
    );

    function tirggerToast(toastNotification: ToastNotification): void {
        const options = { autoClose: toastNotification.closesAfter };

        switch (toastNotification.variant) {
            case 'success':
                toast.success(toastNotification.message, options);
                break;
            case 'critical':
                toast.error(toastNotification.message, options);
                break;
            case 'warning':
                toast.warn(toastNotification.message, options);
                break;
            default:
                toast.info(toastNotification.message, options);
                break;
        }
    }

    onMounted(() => {
        toastNotifications.value.forEach((toast) => {
            tirggerToast(toast);
        });
    });
}
