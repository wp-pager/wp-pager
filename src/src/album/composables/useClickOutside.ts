import type { Ref } from 'vue'
import { onMounted, onBeforeUnmount } from 'vue'

export default (el: Ref<HTMLElement | null>, callback: () => void) => {
    function listener(e: MouseEvent) {
        if (!el.value || e.target === el.value || e.composedPath().includes(el.value)) {
            return
        }

        callback()
    }

    onMounted(() => window.addEventListener('click', listener))
    onBeforeUnmount(() => window.removeEventListener('click', listener))
}