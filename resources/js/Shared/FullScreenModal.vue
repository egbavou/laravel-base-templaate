<template>
    <div :class="isOpen ? 'modal-active' : ''" class="bg-gray-900 flex items-center justify-center h-screen">

        <div :class="isOpen ? '' : 'opacity-0 pointer-events-none'" class="modal fixed w-full h-full top-0 left-0 flex items-center justify-center bg-gray-100">

            <div class="modal-overlay absolute w-full h-full bg-white opacity-95"></div>

            <div class="modal-container w-full h-full z-50 overflow-y-auto ">

                <div class="flex fixed  w-full jusytify-start mb-6" >
                    <button  @click="closeModal()" class=" modal-close absolute top-0 left-0 cursor-pointer flex flex-col items-center mt-4 mr-4 text-black text-sm z-50 focus:outline-none">
                        
                        <svg class="ml-4 h-10 w-10" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="15" y1="9" x2="9" y2="15"></line>
                            <line x1="9" y1="9" x2="15" y2="15"></line>
                        </svg>
                    </button>
                </div>
                
                <div class="flex flex-col mt-4  modal-content container mx-auto p-4 min-h-screen  sm:justify-center items-center  sm:pt-0">
                    <slot name="content"></slot>
                </div>

                <div class="flex w-full fixed bottom-0 justify-end pt-2">
                    <slot name="content-footer"></slot>
                </div>

            </div>

        </div>
    </div>
</template>

<script>
export default ({
    data () {
        
        return{

        }
        
    },
    props: {
        isOpen: Boolean,
    },
    
    methods: {
        closeModal(){
            //this.isOpen = false
            this.$emit('closeFullSreenModal')

        }
    },
    computed: {
       
    }
    
})
</script>

<style >
    .modal {
        transition: opacity 0.25s ease;
    }
    .modal-active {
        overflow-x: hidden;
        overflow-y: visible !important;
    }
</style>
