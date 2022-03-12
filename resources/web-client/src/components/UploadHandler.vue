<template>
    <label class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded cursor-pointer">
        Загрузить
        <input
            type="file"
            hidden
            @change="upload($event.target.files)"
        />
    </label>
</template>

<script>
import axios from 'axios'

export default {
    name: 'UploadHandler',
    emits: ['fileUploaded'],
    props: ['id'],
    setup(props, {emit}) {
        const upload = async (files) => {
            const file = files.item(0)
            const data = new FormData()
            if (props.id) {
                data.append('id', props.id)
            }
            data.append('image', file)
            const response = await axios.post('upload', data)
            emit('fileUploaded', response.data.image_name)
        }
        return {
            upload
        }
    }
}
</script>
