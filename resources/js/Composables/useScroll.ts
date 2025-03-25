import VueScrollTo from 'vue-scrollto';
const options = {
    container: '#container',
    easing: 'ease-in',
    lazy: false,
    offset: -60,
    force: true,
    cancelable: true,
    onStart: false,
    onDone: false,
    onCancel: false,
    // onStart: function (element: unknown) {},
    // onDone: function (element: unknown) {},
    // onCancel: function () {},
    x: false,
    y: true,
};
const scrollTo = (id: string) => {
    return VueScrollTo.scrollTo(id);
};
export default function useScroll() {
    return {
        scrollTo,
    };
}
