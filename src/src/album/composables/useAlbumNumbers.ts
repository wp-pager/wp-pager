import type { ImageFile } from '@shared/types'
import { useStore } from 'vuex'
import { computed } from 'vue'

export default () => {
    const store = useStore()
    const files = computed<ImageFile[]>(() => store.getters['files/files'])
    const prevPageNum = computed<number>(() => store.getters['files/prevPageNum'])

    type GroupedFile = {
        title: string | number
        visible: boolean
        files: ImageFile[]
    }

    const groupedFiles = computed<GroupedFile[]>(() => {
        if (!files.value) {
            return []
        }

        const result: GroupedFile[] = files.value.reduce((groups: GroupedFile[], file: ImageFile) => {
            const matchedGroup = groups.find(g => g.title === file.title || g.title === file.page)

            if (!matchedGroup) {
                const newGroup = {
                    title: file.title || file.page,
                    visible: false,
                    files: [file]
                }

                groups.push(newGroup)

                return groups
            }

            matchedGroup.files.push(file)

            return groups
        }, [])

        if (result.length > 0) {
            result[0].visible = true
        }

        return result
    })

    async function pageChosenHandler(pageNum: number) {
        if (pageNum > prevPageNum.value) {
            await store.dispatch('swipe/setTouchStart', 1)
            await store.dispatch('swipe/setTouchEnd', 0)
        } else if (pageNum < prevPageNum.value) {
            await store.dispatch('swipe/setTouchStart', 0)
            await store.dispatch('swipe/setTouchEnd', 1)
        }

        await store.dispatch('files/setPrevPageNum', pageNum)
        await store.dispatch('files/setCurrPageNum', pageNum)
    }

    return {
        groupedFiles,
        pageChosenHandler,
    }
}