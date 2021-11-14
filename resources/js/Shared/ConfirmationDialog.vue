<template>

	<confirmation-modal :show="show" :closeable="closeable" @close="close" v-if="show.default">

		<template #title>
				<h1>{{title}}</h1>
		</template>

		<template #content>
			<!-- <div class="flex justify-center	">
				<svg xmlns="http://www.w3.org/2000/svg" width="44" height="44" viewBox="0 0 24 24" fill="none" stroke="#e74c3c" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
					<path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
					<line x1="12" y1="9" x2="12" y2="13"></line>
					<line x1="12" y1="17" x2="12.01" y2="17"></line>
				</svg>

			</div> -->
			<div class="flex justify-center	mt-3">
				
				<h1><strong></strong></h1>

			</div>
			<div class="flex justify-center	">
				<p>{{message}}</p>                    
			</div>
		</template>

		<template #footer>
			<div class="py-1 bg-gray-100  border-gray-200 flex justify-end items-center">
				<button class="ml-3 inline-flex  items-center justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-semibold uppercase rounded-md text-black bg-white hover:bg-transparent focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-transparent" @click="close">Annuler</button>
				<danger-button v-if="title==='Confirmation de suppression'" id="confirmDialog"  class="ml-3"  @click="confirm()">Confirmer</danger-button>
				<button v-else id="confirmDialog"  @click="confirm()" class="ml-3 inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-700 focus:outline-none focus:border-green-700 focus:shadow-outline-green disabled:opacity-25 transition">Confirmer</button>
            </div>
				                 
		</template>

	</confirmation-modal>
    <!-- <h1>JE suis là</h1> -->

</template>

<script>

import DialogModal from '@/Jetstream/DialogModal'
import ConfirmationModal from '@/Jetstream/ConfirmationModal'
import DangerButton from '@/Jetstream/DangerButton'


export default {
	emits: ['confirm'],

  	components: {
        DialogModal,
		ConfirmationModal,
		DangerButton
	},
	data() {
		return {
			
		}
	},
    props: {
		message : String,
		title : String,
		show:{
			default: false
		},
		closeable:{
			default: true
		}
    },
  	mounted(){
		if(!this.title){
			this.title = 'Confirmation de suppression'
			console.log(this.title)

		}
  	},
	methods: {
		close () {
			this.show.default = false;
		},
		confirm(){
			this.$emit('confirm');
		}
	},

	watch:{
		
	}
}
	
</script>

<style>
	
</style>


