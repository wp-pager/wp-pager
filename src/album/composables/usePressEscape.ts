import { onMounted, onBeforeUnmount } from 'vue'

export default (callback: () => void) => {
    function listener(e: KeyboardEvent) {
        if (!['Escape', 'Esc'].includes(e.key)) {
            return
        }

        callback()
    }

    onMounted(() => window.addEventListener('keydown', listener))
    onBeforeUnmount(() => window.removeEventListener('keydown', listener))
}