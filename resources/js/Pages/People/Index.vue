<template>
  <div class="mt-8" v-on:keyup.enter="confirm()" v-on:keyup.esc="cancel()">
    <div class="max-w-full mx-auto px-4 sm:px-6 lg:px-8">
      <div class="px-4 sm:px-6 md:px-0">
        <div class="pb-5 sm:flex sm:items-center sm:justify-between">
          
         <div class="flex">
            <h3 class="text-3xl font-extrabold text-gray-900">
                Personnes
            </h3>
            <div class="mt-3 sm:mt-0 sm:ml-4">
            
            </div>
         </div>
          
          <div class="mt-3 sm:mt-0 sm:ml-4">
            <inertia-link class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" :href="route('people.create')">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
              </svg>
              Nouveau
            </inertia-link>
          </div>
        </div>

        <!-- This example requires Tailwind CSS v2.0+ -->
        <div class="flex flex-col">
          <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
              
              <div class="flex ">

                <div class="w-1/2 mr-3">
                  <div class="pb-4">
                    <div class="mt-1 relative rounded-md z-10">
                      <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                      </div>
                      <input v-model="form.search" type="text" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-10 sm:text-sm border-gray-300 rounded-md" placeholder="Rechercher">
                    </div>
                  </div>
                </div>

              </div> 

          
              <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200 ">
                  <thead class="bg-gray-50">
                    <tr>
                        
                        <th scope="col" class="relative px-6 py-3">
                            <span class="sr-only">Actions</span>
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Nom
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Prénom
                        </th>
                       
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                           Registre National
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Adresse
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Code postal
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Ville
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Email 
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Phone
                        </th>
                       
                    </tr>
                  </thead>
                  <tbody>
                    <!-- Odd row -->
                    <tr v-for="person in people.data" :key="person.id" class="bg-white">
                     
                      <td class="px-6 py-4 whitespace-nowrap text-left text-sm font-medium">
                        <inertia-link class="outline-none text-indigo-600 hover:text-indigo-900" :href="route('people.edit', person.id)" style="display: inline">
                          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="display: inline">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                          </svg>
                        </inertia-link>
                        <button :loading="sending" class="outline-none text-indigo-600 hover:text-indigo-900" style="display: inline" type="button" @click="destroy(person.id)">
                          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="display: inline">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                          </svg>
                        </button>
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        {{person.last_name}}
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        {{person.first_name}}
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        {{person.national_registry}}
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        {{person.address}}
                      </td>
                      
                      <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        {{ person.postal_code}}
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        {{ person.city}}
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        {{ person.email}}
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        {{ person.phone}}
                      </td>

                    </tr>
                    <tr v-if="people.data.length === 0">
                      <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium" colspan="10">Pas de personnes.</td>
                    </tr>
                  </tbody>
                </table>
                
              </div>
              <br>
              <pagination :links="people.links"/>
            </div>
          </div>
        </div>

        <confirmation-dialog 
          v-if="showModal"
          :message="message"
          :title="title"
          :show="show"
          :closeable="closeable"
          @confirm="confirm()"/>
       
      </div>
    </div>
  </div>    

</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import Pagination from '@/Shared/Pagination'
import throttle from 'lodash/throttle'
import pickBy from 'lodash/pickBy'
import ConfirmationDialog from '@/Shared/ConfirmationDialog'
import LoadingButton from '@/Shared/LoadingButton'

export default {
  created () {
    //console.log(this.filters)
    //console.log(this.people)
    //console.log(this.total_person)
    
  },
  components: {
    Pagination,
    ConfirmationDialog,
    LoadingButton
  },
  layout: AppLayout,
  props: {
    people: Object,
    filters: Object,
  },
  data() {
    return {
      sending:false,
      form: {
        search: this.filters.search,
      },
      message: null,
      title: null,
      show:{
			  default: true
		  },
      closeable:{
        default: true
      },
      showModal: false,
      itemDeleteId : null
    }
  },
  methods: {
    
    destroy(id) {
      this.showModal = true
      this.show.default = true
      this.itemDeleteId = id
      this.sms_person_id = null
      this.mail_person_id = null
      this.title = 'Confirmation de suppression'
      this.message = 'Êtes-vous sûr de vouloir supprimer cette personne?'
    },
    cancel(){
      this.showModal = false
      this.itemDeleteId = null
    },
    confirm(){
      if(this.itemDeleteId){
        this.showModal = false
        this.$inertia.delete(this.route('people.destroy', this.itemDeleteId));
      }
    },
    
  
  },
  watch: {
    form: {
      handler: throttle(function() {
        let query = pickBy(this.form)
        this.$inertia.get(this.route('people.index', Object.keys(query).length ? query : { remember: 'forget'}), {}, { preserveState: true })
      }, 150),
      deep: true,
    },
  },
}
</script>

<style src="vue-multiselect/dist/vue-multiselect.css"></style>