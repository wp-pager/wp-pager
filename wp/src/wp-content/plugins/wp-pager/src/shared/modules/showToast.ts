import toast from 'toastify-js'

type ShowToastParams = {
    text: string
    success?: boolean
    url?: string
    duration?: number
}

export default (params: ShowToastParams) => {
    if (typeof params.success === 'undefined')
        params.success = true

    const successIcon = pager.rootUrl + '/assets/img/success.svg'
    const errorIcon = pager.rootUrl + '/assets/img/error.svg'

    const config: toast.Options = {
        text: params.text,
        destination: params.url || 'javascript:',
        gravity: 'bottom',
        position: 'right',
        backgroundColor: 'white',
        close: true,
        avatar: params.success ? successIcon : errorIcon,
        duration: params.duration || 2000,
        style: {
            display: 'flex',
            justifyContent: 'space-between',
            alignItems: 'center',
            gap: '10px',
            borderRadius: '8px',
            color: '#777',
            padding: '20px 15px',
            boxShadow: '0 0 17px rgba(0, 0, 0, .3)',
            fontSize: '1rem',
        },
    }

    toast(config).showToast()
}