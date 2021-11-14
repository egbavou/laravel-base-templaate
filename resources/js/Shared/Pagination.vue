<template>
  <div v-if="links.length > 3">
    <div class="flex flex-wrap -mb-1">
      <template v-for="link in links" :key="link.label">
        <div v-if="link.url === null" class="mr-1 mb-1 px-4 py-3 text-sm leading-4 text-gray-400 border rounded" v-html="link.label" />
        <inertia-link v-else class="mr-1 mb-1 px-4 py-3 text-sm leading-4 border rounded hover:bg-white focus:border-indigo-500 focus:text-indigo-500" :class="{ 'bg-white': link.active }" :href="changePage(link)" v-html="link.label"/>
        <!-- <button v-else class="mr-1 mb-1 px-4 py-3 text-sm leading-4 border rounded hover:bg-white focus:border-indigo-500 focus:text-indigo-500" :class="{ 'bg-white': link.active }" v-html="link.label" @click="changePage(link)"/> -->
      </template>
    </div>
  </div>
</template>

<script>
import Button from '../Jetstream/Button.vue'

export default {
  components: { Button },
  props: {
    links: Array,
  
  },

  methods: {
    changePage(link){
      if(link.label===this.links[0].label){
        let page_nbr = parseInt(window.location.href.split('&page=')[1])-1
        return window.location.href.split('&page=')[0].indexOf('?')===-1 ? window.location.href.split('&page=')[0]+'?&page='+page_nbr : window.location.href.split('&page=')[0]+'&page='+page_nbr
      }else{
        if(link.label===this.links[(this.links.length-1)].label){
          let page_nbr = parseInt(window.location.href.split('&page=')[1])+1
          return window.location.href.split('&page=')[0].indexOf('?')===-1 ? window.location.href.split('&page=')[0]+'?&page='+page_nbr : window.location.href.split('&page=')[0]+'&page='+page_nbr
        }else{
          return window.location.href.split('&page=')[0].indexOf('?')===-1 ? window.location.href.split('&page=')[0]+'?&page='+link.label : window.location.href.split('&page=')[0]+'&page='+link.label
        }
      }
    }
  }
}
</script>
