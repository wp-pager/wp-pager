import type { ShowToastParams } from '@shared/types'
import toast from 'toastify-js'

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
        close: true,
        avatar: params.success ? successIcon : errorIcon,
        duration: params.duration || 3000,
        style: {
            display: 'flex',
            justifyContent: 'space-between',
            background: 'white',
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