import { Discussion } from '@/types/types';
import { router } from '@inertiajs/vue3';
export default function useToggleDiscussionSolution(
    discussion: Discussion,
    postId: number | string,
) {
    const toggleDiscussionSolution = (isSolution: boolean) => {
        router.patch(
            route('discussions.solution.patch', { discussion: discussion.id }),
            { post_id: isSolution ? null : postId },
            { preserveScroll: true },
        );
    };
    return { toggleDiscussionSolution };
}
