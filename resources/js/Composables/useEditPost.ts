import { Post } from '@/types/types';
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
export default function useEditPost(post: Post) {
    const editing = ref(false);
    const form = useForm({
        body: post.body,
    });
    const editPost = () => {
        form.patch(route('posts.edit', { post: post.id }));
    };
    return { editing, form, editPost };
}
