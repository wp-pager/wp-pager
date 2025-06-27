import showToast from '@shared/modules/showToast'

export default (err: any): void => {
    console.error(err)

    showToast({
        text: 'An error occurred. Please try again later.',
        success: false,
    })
}