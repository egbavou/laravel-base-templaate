<template>
    <modal :show="show" :max-width="maxWidth" :closeable="closeable" @close="close" v-if="show.default">
        
        <div class="px-4 py-4">

            <div class="flex justify-end" @click="close()">
                <svg   xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#9b9b9b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </div>

            <div class="mt-4">
                <slot name="content">
                </slot>
            </div>
        </div>

        <div class="px-6 py-4 bg-gray-100 text-right">
            <slot name="footer">
            </slot>
        </div>
        
    </modal>
</template>

<script>
    import Modal from '@/Jetstream/Modal'

    export default {
        emits: ['close','confirm'],

        components: {
            Modal,
        },

        props: {
            show: {
                default: false
            },
            maxWidth: {
                default: 'xl'
            },
            closeable: {
                default: true
            },
            message:null
        },

        methods: {
            close() {
                //this.$emit('close')
                this.show.default = false

            },
            confirm(){
                this.$emit('confirm');
            },
            
        }
    }
</script>
