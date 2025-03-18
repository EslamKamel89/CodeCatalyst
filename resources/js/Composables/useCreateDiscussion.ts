import { ref } from 'vue';

export default function useCreateDiscussion() {
    const isVisible = ref(false);
    const showForm = () => (isVisible.value = true);
    const hideForm = () => (isVisible.value = false);
    const toggleForm = () => {
        isVisible.value = !isVisible.value;
    };
    return { isVisible, showForm, hideForm, toggleForm };
}
