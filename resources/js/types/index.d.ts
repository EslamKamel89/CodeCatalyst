import { Topic } from './types';

export interface User {
    id: number;
    username: string;
    name: string;
    email: string;
    email_verified_at?: string;
}

export type PageProps<
    T extends Record<string, unknown> = Record<string, unknown>,
> = T & {
    topics: Topic[];
    auth: {
        user: User;
    };
};
