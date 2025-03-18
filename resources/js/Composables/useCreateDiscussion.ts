import { ref } from 'vue';

const isVisible = ref(false);
export default function useCreateDiscussion() {
    const showForm = () => (isVisible.value = true);
    const hideForm = () => (isVisible.value = false);
    const toggleForm = () => {
        isVisible.value = !isVisible.value;
    };
    return { isVisible, showForm, hideForm, toggleForm };
}
