import axios, {
    AxiosError,
    AxiosInstance,
    AxiosRequestConfig,
    AxiosResponse,
} from 'axios';
import { onUnmounted, ref } from 'vue';

const axiosInstance: AxiosInstance = axios.create({
    baseURL: 'http://127.0.0.1:8000', // Change this to your API base URL
    timeout: 10000, // Request timeout in milliseconds
    headers: {
        'Content-Type': 'application/json',
        Accept: 'application/json',
    },
});

// Add response interceptors
axiosInstance.interceptors.response.use(
    (response: AxiosResponse) => response, // Just return the response
    (error: AxiosError) => {
        console.error('API Error:', error);
        return Promise.reject(error); // Forward the error
    },
);

export function useAxios<T = any>(config: AxiosRequestConfig) {
    const data = ref<T | null>(null);
    const error = ref<string | null>(null);
    const loading = ref<boolean>(false);
    const abortController = ref<AbortController | null>(null);

    const execute = async () => {
        loading.value = true;
        error.value = null;
        abortController.value = new AbortController();
        config.signal = abortController.value.signal;

        try {
            const response = await axiosInstance.request<T>(config);
            data.value = response.data;
        } catch (err) {
            error.value = (err as AxiosError).message || 'Unknown error';
        } finally {
            loading.value = false;
        }
    };

    // Auto-fetch when the composable is used
    // watchEffect(() => {
    //     execute();
    // });

    // Cancel request when component unmounts
    onUnmounted(() => {
        abortController.value?.abort();
    });

    return { data, error, loading, execute };
}
