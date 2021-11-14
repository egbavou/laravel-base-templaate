<template>
    <div class="flex justify-center text-center mb-4 ">
        <div @click="chooseImage">
            <img :src="imageData" class="shadow rounded-full h-60 w-60 items-center justify-center border-2 border-gray-300"/>
            <input name="profile" class="file-input" accept="image/png,image/jpeg" ref="fileInput" type="file" @input="onSelectFile">
            <br>
            <label class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Charger une image</label>
        </div>
    </div>
</template>


<script>

export default({
    created () {

        if(this.image){
            this.imageData = this.image
        }
    },
    props: {
        image: null
    },
 
    data () {
        return {
            imageData : 'https://www.gravatar.com/avatar/default?s=200&r=pg&d=mm'
        }
    },
    methods: {
        onSelectFile () {
            const input = this.$refs.fileInput
            const files = input.files
            if (files && files[0]) {
                const reader = new FileReader
                reader.onload = e => {
                    this.imageData = e.target.result
                }
                reader.readAsDataURL(files[0])
                this.$emit('profile', files[0])
            }
        },
        chooseImage () {
            this.$refs.fileInput.click()
        },
        
    },
    setup() {
        
    },
})
</script>

<style>
    .file-input {
        display :  none;
    }
</style>
  components: { Label },