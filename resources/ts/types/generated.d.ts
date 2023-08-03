export namespace Domain.Mail.DataTransferObjects.Broadcasts {
    export type BroadcastData = {
        id: number | null;
        subject: string;
        content: string;
        filters: any | null;
        sent_at: string;
        broadcastStatus: any | null;
    };
}
export namespace Domain.Mail.ViewModels.Broadcast {
    export type GetBroadcastsViewModel = {
        broadcasts: Array<Domain.Mail.DataTransferObjects.Broadcasts.BroadcastData>;
    };
}
export namespace Domain.Subscriber.DataTransferObjects {
    export type FormData = {
        id: number | null;
        title: string;
        content: string;
    };
    export type SubscriberData = {
        id: number | null;
        email: string;
        first_name: string;
        last_name: string | null;
        full_name: string | null;
        subscribed_at: string | null;
        tags?: Array<Domain.Subscriber.DataTransferObjects.TagData> | null;
        form?: Domain.Subscriber.DataTransferObjects.FormData | null;
    };
    export type TagData = {
        id: number | null;
        title: string;
        subscribers?: Array<Domain.Subscriber.DataTransferObjects.SubscriberData> | null;
    };
}
export namespace Domain.Subscriber.ViewModels {
    export type GetSubscribersViewModel = {
        subscribers: {
            current_page: number;
            data: Array<Domain.Subscriber.DataTransferObjects.SubscriberData>;
            first_page_url: string;
            from: number;
            next_page_url: string | null;
            path: string;
            per_page: number;
            prev_page_url: string | null;
            to: number;
        };
        total: number;
    };
}
