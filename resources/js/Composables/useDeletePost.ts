import { Post } from '@/types/types';
import { router } from '@inertiajs/vue3';

export default function useDeletePost(post: Post) {
    const deletePost = () => {
        if (window.confirm('Are You Sure')) {
            router.delete(route('posts.delete', { post: post.id }), {
                preserveScroll: true,
                preserveState: true,
            });
        }
    };
    return { deletePost };
}
