<template>
    <!-- <div :class="{'bg-cyan-800' : showMenu}"> -->
    <div>
        <div class="group flex items-center px-2 py-2 text-sm leading-6 font-medium rounded-md text-cyan-100 hover:text-white hover:bg-cyan-600" @click="toggleShow">
            <slot name="title"/>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" class="flex-none dropdown-menu"  :class="{'rotate-90' : showMenu}" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <path d="M9 18l6-6-6-6"/>
            </svg>
        </div>
        <ul class="ml-4 overflow-hidden dropdown-menu font-normal" :class="size">
            <slot name="childs"></slot>
        </ul>
    </div>
    
</template>


<script>

export default ({
  data () {
    return {
        showMenu: false,
    }
  },
    props: {
        url: String,
        child : false,
        height: null,
        // urls:Array,
        //length: null,
    },
    setup() {
        
    },
    methods: {
        toggleShow() {
            this.showMenu = !this.showMenu;
        },
       
    },
    computed: {
        size() {
            return this.showMenu ? this.height : "h-0";
            //return this.showMenu ?  this.height = this.height * 48 : "h-0";
        }
    }
    
})
</script>


<style scoped>
    .dropdown-menu {
        transition: 300ms;
    }
    svg.rotate-90 {
        transform: rotate(90deg);
    }
</style>