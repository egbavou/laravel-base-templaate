<template>
    <div >
        <div v-if="hiddeMenu" class="fixed inset-0 flex z-40 lg:hidden" role="dialog" aria-modal="true">
            <div class="fixed inset-0 bg-gray-600 bg-opacity-75" aria-hidden="true"></div>
                <div class="relative flex-1 flex flex-col max-w-xs w-full bg-gray-600">
                    <div class="absolute top-0 right-0 -mr-12 pt-2" @click="toggleMenu()" >
                        <button class="ml-1 flex items-center justify-center h-10 w-10 rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white">
                            <span class="sr-only">Close sidebar</span>
                            <!-- Heroicon name: outline/x -->
                            <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <div class="flex-shrink-0 flex items-center">
                        <img class="h-full w-full" :src="baseUrl+'/img/logo.jpg'" alt="Charnoy">
                    </div>
                    <nav class="mt-5 flex-shrink-0 h-full divide-y divide-white overflow-y-auto" aria-label="Sidebar">
                        <div class="px-2 space-y-1">
                           

                            <inertia-link v-show="$page.props.user.is_admin" :class="isUrl('people') ? 'bg-gray-800 text-white group flex items-center px-2 py-2 text-sm leading-6 font-medium rounded-md' : 'group flex items-center px-2 py-2 text-sm leading-6 font-medium rounded-md text-white hover:text-white hover:bg-gray-700'" :href="route('people.index')">
                                <svg xmlns="http://www.w3.org/2000/svg" class="mr-4 h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="9" cy="7" r="4"></circle>
                                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                </svg>
                                Personnes
                            </inertia-link>

                        </div>
                        <div class="mt-6 pt-6">
                            <div class="px-2 space-y-1">
                                
                            </div>
                        </div>
                    </nav>
                </div>

            <div class="flex-shrink-0 w-14" aria-hidden="true">
            <!-- Dummy element to force sidebar to shrink to fit close icon -->
            </div>
        </div>

        <!-- Static sidebar for desktop -->
        <div class="hidden h-screen lg:flex lg:flex-shrink-0" @mouseover="openWhenIsLock()" @mouseleave="closeWhenIsLock()">
            <div class="flex transition-all duration-500 flex-col w-auto">
                <div class="flex flex-col flex-grow overflow-y-auto">
                    
                    <nav class="flex-1 flex flex-col divide-y divide-gray-600 overflow-y-auto" aria-label="Sidebar">
                        <div v-if="!isLock " class="">
                            <img :src="baseUrl+'/img/logo_large.jpg'" alt="" class="">
                        </div>
                        <div v-else class="">
                            <img :src="baseUrl+'/img/logo_min.jpg'" alt="" class="w-full">
                        </div>
                        <div class="pt-6 bg-gray-600 h-full">
                            
                            <div class="space-y-1 space-y-1 pt-5">

                                
                                <inertia-link v-show="$page.props.user.is_admin" :class="isUrl('people') ? 'bg-gray-800 text-white group flex items-center px-2 py-2 text-sm leading-6 font-medium' : 'group flex items-center px-2 py-2 text-sm leading-6 font-medium text-white hover:text-white hover:bg-gray-700'" :href="route('people.index')">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="mr-4 h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="9" cy="7" r="4"></circle>
                                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                    </svg>
                                    <span v-if="!isLock">Personnes</span>
                                </inertia-link>


                            </div>
                        </div>
                    </nav>
                    <div class="divide-y divide-white">
                        <button @click="lock()" class="w-full inline-flex items-center px-2 py-2 border border-transparent text-xs font-medium shadow-sm text-white bg-gray-600 hover:bg-gray-800 focus:outline-none">
                            <svg v-if="lockSidebar" xmlns="http://www.w3.org/2000/svg" :class="!isLock ? 'mr-4' : '' " class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                            </svg>
                            <svg v-if="!lockSidebar" xmlns="http://www.w3.org/2000/svg" :class="!isLock ? 'mr-4' : '' " class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                <path d="M7 11V7a5 5 0 0 1 9.9-1"></path>
                            </svg>
                            <span v-if="!isLock">Menu verrouillage</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

import DropdownMenu from '@/Shared/DropdownMenu'
export default {
    created () {
        this.baseUrl = window.location.origin
    },
    data () {
        return {
            baseUrl : null,
            isLock: false,
            lockSidebar:false
        }
    },
    props: {
        hiddeMenu: Boolean
    },
    computed : {

        width: {
           get() {
                return  screen.width;
           }
        }
    },
    components: {
        DropdownMenu
    },
    methods: {
        isUrl(...urls) {
            let currentUrl = this.$page.url.substr(1)

            if (urls[0] === '') {
                return currentUrl === ''
            }

            return urls.filter(url => currentUrl.startsWith(url)).length
        },
        toggleMenu()
        {
            //console.log('toogle sidebar');
            this.$emit('hidde')
            
        },
        lock(){
            if(this.lockSidebar){
                this.isLock = false
                this.lockSidebar = false
            }else{
                this.isLock = true
                this.lockSidebar = true
            }
            this.$emit('lock',this.isLock)
        },
        openWhenIsLock(){
            if(this.lockSidebar){
                this.isLock = false
            }
            this.$emit('lock',this.isLock)
        },
        closeWhenIsLock(){
            if(this.lockSidebar){
                this.isLock = true
            }
            this.$emit('lock',this.isLock)
        }
       
        
    },
}
</script>