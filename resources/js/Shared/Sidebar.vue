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
                            <inertia-link :class="isUrl('companies') ? 'bg-gray-800 text-white group flex items-center px-2 py-2 text-sm leading-6 font-medium rounded-md' : 'group flex items-center px-2 py-2 text-sm leading-6 font-medium rounded-md text-white hover:text-white hover:bg-gray-700'" :href="route('companies.index')">
                                <svg xmlns="http://www.w3.org/2000/svg" class="mr-4 h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                    <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                </svg>
                                Entreprises
                            </inertia-link>

                            <inertia-link v-show="$page.props.user.is_admin" :class="isUrl('events') ? 'bg-gray-800 text-white group flex items-center px-2 py-2 text-sm leading-6 font-medium rounded-md' : 'group flex items-center px-2 py-2 text-sm leading-6 font-medium rounded-md text-white hover:text-white hover:bg-gray-700'" :href="route('events.index')">
                                <svg xmlns="http://www.w3.org/2000/svg" class="mr-4 h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="2" y="4" width="20" height="16" rx="2"/>
                                    <path d="M7 15h0M2 9.5h20"/>
                                </svg>
                                Evénements
                            </inertia-link>

                            <inertia-link v-show="$page.props.user.is_admin" :class="isUrl('people') ? 'bg-gray-800 text-white group flex items-center px-2 py-2 text-sm leading-6 font-medium rounded-md' : 'group flex items-center px-2 py-2 text-sm leading-6 font-medium rounded-md text-white hover:text-white hover:bg-gray-700'" :href="route('people.index')">
                                <svg xmlns="http://www.w3.org/2000/svg" class="mr-4 h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="9" cy="7" r="4"></circle>
                                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                </svg>
                                Personnes
                            </inertia-link>

                            <inertia-link :class="isUrl('participants') ? 'bg-gray-800 text-white group flex items-center px-2 py-2 text-sm leading-6 font-medium rounded-md' : 'group flex items-center px-2 py-2 text-sm leading-6 font-medium rounded-md text-white hover:text-white hover:bg-gray-700'" :href="route('participants.index')">
                                <svg xmlns="http://www.w3.org/2000/svg" class="mr-4 h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                    <polyline points="22,6 12,13 2,6"></polyline>
                                </svg>
                                Participants
                            </inertia-link>
                            
                            <inertia-link v-show="$page.props.user.is_admin" :class="isUrl('orders') ? 'bg-gray-800 text-white group flex items-center px-2 py-2 text-sm leading-6 font-medium rounded-md' : 'group flex items-center px-2 py-2 text-sm leading-6 font-medium rounded-md text-white hover:text-white hover:bg-gray-700'" :href="route('orders.index')">
                                <svg xmlns="http://www.w3.org/2000/svg" class="mr-4 h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <circle cx="10" cy="20.5" r="1"/><circle cx="18" cy="20.5" r="1"/>
                                    <path d="M2.5 2.5h3l2.7 12.4a2 2 0 0 0 2 1.6h7.7a2 2 0 0 0 2-1.6l1.6-8.4H7.1"/>
                                </svg>
                                Commandes
                            </inertia-link>

                            <inertia-link v-show="$page.props.user.is_admin" :class="isUrl('bars') ? 'bg-gray-800 text-white group flex items-center px-2 py-2 text-sm leading-6 font-medium rounded-md' : 'group flex items-center px-2 py-2 text-sm leading-6 font-medium rounded-md text-white hover:text-white hover:bg-gray-700'" :href="route('bars.index')">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="mr-4 h-6 w-6 text-white" viewBox="0 0 16 16">
                                    <path d="M0 2a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1v7.5a2.5 2.5 0 0 1-2.5 2.5h-9A2.5 2.5 0 0 1 1 12.5V5a1 1 0 0 1-1-1V2zm2 3v7.5A1.5 1.5 0 0 0 3.5 14h9a1.5 1.5 0 0 0 1.5-1.5V5H2zm13-3H1v2h14V2zM5 7.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z"/>
                                </svg>
                                Bars
                            </inertia-link>

                            <inertia-link v-show="$page.props.user.is_admin" :class="isUrl('consummations') ? 'bg-gray-800 text-white group flex items-center px-2 py-2 text-sm leading-6 font-medium rounded-md' : 'group flex items-center px-2 py-2 text-sm leading-6 font-medium rounded-md text-white hover:text-white hover:bg-gray-700'" :href="route('consummations.index')">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="mr-4 h-6 w-6 text-white" viewBox="0 0 16 16">
                                    <path d="M5.071 1.243a.5.5 0 0 1 .858.514L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15.5a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5H15v5a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V9H.5a.5.5 0 0 1-.5-.5v-2A.5.5 0 0 1 .5 6h1.717L5.07 1.243zM3.5 10.5a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0v-3zm2.5 0a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0v-3zm2.5 0a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0v-3zm2.5 0a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0v-3zm2.5 0a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0v-3z"/>
                                </svg>

                                Consommations
                            </inertia-link>

                            <inertia-link :class="isUrl('helps') ? 'bg-gray-800 text-white group flex items-center px-2 py-2 text-sm leading-6 font-medium rounded-md' : 'group flex items-center px-2 py-2 text-sm leading-6 font-medium rounded-md text-white hover:text-white hover:bg-gray-700'" :href="route('helps.create')">
                                <svg xmlns="http://www.w3.org/2000/svg" class="mr-4 h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path>
                                    <line x1="12" y1="17" x2="12.01" y2="17"></line>
                                </svg>
                                Aide
                            </inertia-link>

                            <inertia-link v-show="$page.props.user.is_admin" :class="isUrl('scan-qr-codes') ? 'bg-gray-800 text-white group flex items-center px-2 py-2 text-sm leading-6 font-medium rounded-md' : 'group flex items-center px-2 py-2 text-sm leading-6 font-medium rounded-md text-white hover:text-white hover:bg-gray-700'" :href="route('scan.qr.code.index')">
                                <svg xmlns="http://www.w3.org/2000/svg" class="mr-4 h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="4" y="2" width="16" height="20" rx="2" ry="2"></rect>
                                    <circle cx="12" cy="14" r="4"></circle>
                                    <line x1="12" y1="6" x2="12.01" y2="6"></line>
                                </svg>
                                Scan QR
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

                                <inertia-link  :class="isUrl('companies') ? 'bg-gray-800 text-white group flex items-center px-2 py-2 text-sm leading-6 font-medium' : 'group flex items-center px-2 py-2 text-sm leading-6 font-medium text-white hover:text-white hover:bg-gray-700'" :href="route('companies.index')">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="mr-4 h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                    </svg>
                                    <span v-if="!isLock">Entreprises</span>
                                </inertia-link>

                                <inertia-link v-show="$page.props.user.is_admin" :class="isUrl('events') ? 'bg-gray-800 text-white group flex items-center px-2 py-2 text-sm leading-6 font-medium' : 'group flex items-center px-2 py-2 text-sm leading-6 font-medium text-white hover:text-white hover:bg-gray-700'" :href="route('events.index')">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="mr-4 h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="2" y="4" width="20" height="16" rx="2"/>
                                        <path d="M7 15h0M2 9.5h20"/>
                                    </svg>
                                    <span v-if="!isLock">Evénements</span>
                                </inertia-link>

                                <inertia-link v-show="$page.props.user.is_admin" :class="isUrl('people') ? 'bg-gray-800 text-white group flex items-center px-2 py-2 text-sm leading-6 font-medium' : 'group flex items-center px-2 py-2 text-sm leading-6 font-medium text-white hover:text-white hover:bg-gray-700'" :href="route('people.index')">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="mr-4 h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="9" cy="7" r="4"></circle>
                                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                    </svg>
                                    <span v-if="!isLock">Personnes</span>
                                </inertia-link>

                                <inertia-link :class="isUrl('participants') ? 'bg-gray-800 text-white group flex items-center px-2 py-2 text-sm leading-6 font-medium' : 'group flex items-center px-2 py-2 text-sm leading-6 font-medium text-white hover:text-white hover:bg-gray-700'" :href="route('participants.index')">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="mr-4 h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                        <polyline points="22,6 12,13 2,6"></polyline>
                                    </svg>
                                    <span v-if="!isLock">Participants</span>
                                </inertia-link>

                                <inertia-link :class="isUrl('orders') ? 'bg-gray-800 text-white group flex items-center px-2 py-2 text-sm leading-6 font-medium' : 'group flex items-center px-2 py-2 text-sm leading-6 font-medium text-white hover:text-white hover:bg-gray-700'" :href="route('orders.index')">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="mr-4 h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <circle cx="10" cy="20.5" r="1"/><circle cx="18" cy="20.5" r="1"/>
                                        <path d="M2.5 2.5h3l2.7 12.4a2 2 0 0 0 2 1.6h7.7a2 2 0 0 0 2-1.6l1.6-8.4H7.1"/>
                                    </svg>
                                    <span v-if="!isLock"> Commandes</span>
                                </inertia-link>

                                <inertia-link v-show="$page.props.user.is_admin" :class="isUrl('bars') ? 'bg-gray-800 text-white group flex items-center px-2 py-2 text-sm leading-6 font-medium' : 'group flex items-center px-2 py-2 text-sm leading-6 font-medium text-white hover:text-white hover:bg-gray-700'" :href="route('bars.index')">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="mr-4 h-6 w-6 text-white" viewBox="0 0 16 16">
                                        <path d="M0 2a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1v7.5a2.5 2.5 0 0 1-2.5 2.5h-9A2.5 2.5 0 0 1 1 12.5V5a1 1 0 0 1-1-1V2zm2 3v7.5A1.5 1.5 0 0 0 3.5 14h9a1.5 1.5 0 0 0 1.5-1.5V5H2zm13-3H1v2h14V2zM5 7.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z"/>
                                    </svg>
                                    <span v-if="!isLock">  Bars</span>
                                </inertia-link>

                                <inertia-link v-show="$page.props.user.is_admin" :class="isUrl('consummations') ? 'bg-gray-800 text-white group flex items-center px-2 py-2 text-sm leading-6 font-medium' : 'group flex items-center px-2 py-2 text-sm leading-6 font-medium text-white hover:text-white hover:bg-gray-700'" :href="route('consummations.index')">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="mr-4 h-6 w-6 text-white" viewBox="0 0 16 16">
                                        <path d="M5.071 1.243a.5.5 0 0 1 .858.514L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15.5a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5H15v5a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V9H.5a.5.5 0 0 1-.5-.5v-2A.5.5 0 0 1 .5 6h1.717L5.07 1.243zM3.5 10.5a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0v-3zm2.5 0a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0v-3zm2.5 0a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0v-3zm2.5 0a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0v-3zm2.5 0a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0v-3z"/>
                                    </svg>
                                    <span v-if="!isLock">Consommations</span>
                                </inertia-link>

                                <inertia-link :class="isUrl('helps') ? 'bg-gray-800 text-white group flex items-center px-2 py-2 text-sm leading-6 font-medium' : 'group flex items-center px-2 py-2 text-sm leading-6 font-medium text-white hover:text-white hover:bg-gray-700'" :href="route('helps.create')">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="mr-4 h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path>
                                        <line x1="12" y1="17" x2="12.01" y2="17"></line>
                                    </svg>
                                    <span v-if="!isLock">Aide</span>
                                </inertia-link>

                                <inertia-link v-show="$page.props.user.is_admin" :class="isUrl('scan-qr-codes') ? 'bg-gray-800 text-white group flex items-center px-2 py-2 text-sm leading-6 font-medium' : 'group flex items-center px-2 py-2 text-sm leading-6 font-medium text-white hover:text-white hover:bg-gray-700'" :href="route('scan.qr.code.index')">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="mr-4 h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="4" y="2" width="16" height="20" rx="2" ry="2"></rect>
                                        <circle cx="12" cy="14" r="4"></circle>
                                        <line x1="12" y1="6" x2="12.01" y2="6"></line>
                                    </svg>
                                    <span v-if="!isLock">Scan QR</span>
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