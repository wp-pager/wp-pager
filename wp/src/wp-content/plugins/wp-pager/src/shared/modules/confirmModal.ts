import type { SweetAlertOptions } from 'sweetalert2'
import Swal from 'sweetalert2'

export default async <T = any>(options?: SweetAlertOptions<T>): Promise<boolean> => {
    const answer = await Swal.fire({
        title: 'Are you sure?',
        showConfirmButton: true,
        showCancelButton: true,
        confirmButtonText: 'Yes',
        cancelButtonText: 'No',
        confirmButtonAriaLabel: 'Yes',
        cancelButtonAriaLabel: 'No',
        confirmButtonColor: '#668466',
        cancelButtonColor: '#9a4949',
        ...options,
    })

    return answer.isConfirmed
}