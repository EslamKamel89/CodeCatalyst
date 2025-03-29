import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const isVisible = ref(false);
const markDownPreview = ref(false);
const form = useForm({
    topic_id: null as null | number,
    title: null as null | string,
    body: '',
});
// const form = useForm();
export default function useCreateDiscussion() {
    const showForm = () => (isVisible.value = true);
    const hideForm = () => (isVisible.value = false);
    const toggleForm = () => {
        isVisible.value = !isVisible.value;
    };
    return { isVisible, showForm, hideForm, toggleForm, form, markDownPreview };
}
