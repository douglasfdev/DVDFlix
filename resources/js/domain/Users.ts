import { Links, Meta } from "@/infra/domain";

export interface User {
    name: string;
    email: string;
    phone?: string;
    links: Array<{
        rel: string;
        href: string;
    }>;
}

export interface UserApiResponse {
    data: {
        data: User[];
        links: Links;
        meta: Meta;
    };
}
