import { User } from '@/types/index';
export interface Topic {
    id: number;
    name: string;
    slug: string;
    created_at: string;
    updated_at: string;
}

export interface Pagination<T> {
    data: T[];
    links: Links;
    meta: Meta;
}

export interface Discussion {
    id: number;
    user_id: number;
    topic_id: number;
    title: string;
    slug: string;
    pinned_at: string;
    is_pinned: boolean;
    replies_count?: number;
    topic: Topic;
    post?: Post;
    latest_post?: Post;
    particpants: User[];
    user_can: {
        reply: boolean;
    };
}

export interface Links {
    first: string;
    last: string;
    prev: string;
    next: string;
}

export interface Meta {
    current_page: number;
    from: number;
    last_page: number;
    links: Link[];
    path: string;
    per_page: number;
    to: number;
    total: number;
}

export interface Link {
    url?: string;
    label: string;
    active: boolean;
}

export interface Post {
    id: number;
    user_id: number;
    discussion_id: number;
    parent_id: number;
    body: string;
    body_markdown: string;
    body_preview?: string;
    body_preview_markdown?: string;
    created_at: DateTime;
    updated_at: DateTime;
    user?: User;
    discussion: Discussion;
    user_can?: {
        update: boolean;
        delete: boolean;
    };
}

export interface DateTime {
    human: string;
    datetime: string;
}

export interface DiscussionIndexQuery {
    filter?: DiscussionIndexFilter;
}

export interface DiscussionIndexFilter {
    noreplies?: string;
    mine?: string;
    participating?: string;
    topic_id?: number;
}
