import { Discussion } from '@/types/types';
import { router } from '@inertiajs/vue3';
export default function useDeleteDiscussion(discussion: Discussion) {
    const deleteDiscussion = () => {
        if (window.confirm('Are You Sure')) {
            router.delete(
                route('discussions.delete', { discussion: discussion.id }),
            );
        }
    };
    return { deleteDiscussion };
}
