type ToastNotificationVariant = 'success' | 'critical' | 'warning' | 'default';

interface ToastNotification {
    message: string;
    variant: ToastNotificationVariant;
    closesAfter: number;
}
