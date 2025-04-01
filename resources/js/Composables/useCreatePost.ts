import { Discussion } from '@/types/types';
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const isVisible = ref(false);
const markDownPreview = ref(false);
const discussion = ref<Discussion | null>(null);
const form = useForm({
    body: null as null | string,
});
// const form = useForm();
export default function useCreatePost() {
    // if (replyTo) form.body = `@${replyTo}`;
    const showForm = () => (isVisible.value = true);
    const hideForm = () => (isVisible.value = false);
    const toggleForm = () => {
        isVisible.value = !isVisible.value;
    };
    const setDiscussion = (discussionParam: Discussion) => {
        discussion.value = discussionParam;
    };
    return {
        isVisible,
        showForm,
        hideForm,
        toggleForm,
        form,
        markDownPreview,
        discussion,
        setDiscussion,
    };
}
