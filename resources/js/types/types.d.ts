export interface Topic {
    id: number;
    name: string;
    slug: string;
    created_at: string;
    updated_at: string;
}

export function isTopic(value: unknown): value is Topic {
    if (!isPlainObject(value)) return false;
    if (!value.hasOwn('id')) return false;
    if (!value.hasOwn('name')) return false;
    if (!value.hasOwn('slug')) return false;
    if (!value.hasOwn('created_at')) return false;
    if (!value.hasOwn('updated_at')) return false;
    return true;
}
