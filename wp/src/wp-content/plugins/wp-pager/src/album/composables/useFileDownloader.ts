import axios, { AxiosResponse } from 'axios'

export default () => {
    async function downloadFile(url: string): Promise<boolean> {
        const resp = await fetchFile(url)

        if (!resp) {
            return false
        }

        const blob = new Blob([resp.data], {
            type: resp.data.type,
        })

        const a = document.createElement('a')

        a.href = URL.createObjectURL(blob)
        a.download = url.split('/').pop() || 'file.jpg'

        a.click()

        URL.revokeObjectURL(a.href)

        return true
    }

    async function fetchFile(url: string): Promise<AxiosResponse<Blob, any> | null> {
        try {
            return await axios.get<Blob>(url, { responseType: 'blob' })
        } catch (e) {
            console.error(e)
            return null
        }
    }

    return {
        downloadFile,
    }
}