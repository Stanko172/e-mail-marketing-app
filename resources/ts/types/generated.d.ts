declare namespace Domain.Subscriber.DataTransferObjects {
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
        tags: Array<Domain.Subscriber.DataTransferObjects.TagData> | null;
        form: Domain.Subscriber.DataTransferObjects.FormData | null;
    };
    export type TagData = {
        id: number | null;
        title: string;
        subscribers?: Array<Domain.Subscriber.DataTransferObjects.SubscriberData> | null;
    };
}
