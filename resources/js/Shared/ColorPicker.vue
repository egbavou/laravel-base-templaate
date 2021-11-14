<template>
    <div class="bg-white mx-auto my-auto">
		<div>
			<label for="color-picker" class="block text-sm font-medium text-gray-700">Couleur</label>
			<div class="flex relative">
        		<input id="color-picker" name="color" class="flex-1 border border-gray-400 p-2 rounded-lg" v-model="currentColor" disabled>
				<div @click="toggle"  class="cursor-pointer rounded-full ml-3 my-auto h-10 w-10 flex" :class="`bg-${currentColor}`" id="svg">
					<svg xmlns="http://www.w3.org/2000/svg" :class="`${iconColor}`" class="h-6 w-6 mx-auto my-auto fill-current"  viewBox="0 0 24 24" stroke="currentColor" id="svg">
						<path id="svg" fill="none" d="M15.584 10.001L13.998 8.417 5.903 16.512 5.374 18.626 7.488 18.097z"/>
						<path id="svg" d="M4.03,15.758l-1,4c-0.086,0.341,0.015,0.701,0.263,0.949C3.482,20.896,3.738,21,4,21c0.081,0,0.162-0.01,0.242-0.03l4-1 c0.176-0.044,0.337-0.135,0.465-0.263l8.292-8.292l1.294,1.292l1.414-1.414l-1.294-1.292L21,7.414 c0.378-0.378,0.586-0.88,0.586-1.414S21.378,4.964,21,4.586L19.414,3c-0.756-0.756-2.072-0.756-2.828,0l-2.589,2.589l-1.298-1.296 l-1.414,1.414l1.298,1.296l-8.29,8.29C4.165,15.421,4.074,15.582,4.03,15.758z M5.903,16.512l8.095-8.095l1.586,1.584 l-8.096,8.096l-2.114,0.529L5.903,16.512z"/>
					</svg>
				</div>
				
				<div  v-show="isOpen" v-click-outside="onClickAway" :class="direction" class="border border-gray-300 origin-top-right absolute right-0  mt-2 rounded-md shadow-lg" id="color-content">
					<transition enter-active-class="ease-out duration-100"
						enter-from-class="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
						enter-to-class="opacity-100 translate-y-0 sm:scale-100"
						leave-active-class="ease-in duration-75"
						leave-from-class="opacity-100 translate-y-0 sm:scale-100"
						leave-to-class="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
				
						<div class="rounded-md bg-white shadow-xs p-2">
							<div class="flex">
								<div v-for="color in colors" :key="color">
									<div class="">
										<div v-for="variant in variants" :key="variant">
											
											<div v-if="currentColor===color+'-'+variant" @click="selectColor(color,variant)" style="box-shadow: 0 0 0 2px rgba(0, 0, 0, 0.2);" class="w-8 h-8 inline-flex rounded-full cursor-pointer border-4 border-white"   :class="`bg-${color}-${variant}`" id="color"></div>
											<div v-else @click="selectColor(color,variant)" class="w-8 h-8 inline-flex rounded-full cursor-pointer border-4 border-white focus:outline-none focus:shadow-outline" :class="`bg-${color}-${variant}`" id="color"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</transition>
					
				</div>
			</div>
		</div>
	</div>
</template>

<script>

export default ({

	emits: ['color'],
    props: {
		direction : String,
		defaultColor: String,
    },
    components: {
    },
	mounted() {
		this.currentColor = this.defaultColor
        this.iconColor = 'text-white'
	},
    data() {
		return {
			colors: ['gray', 'red', 'yellow', 'green', 'blue', 'indigo', 'purple', 'pink'],
			variants: [100, 200, 300, 400, 500, 600, 700, 800, 900],
			iconColor: '',
			currentColor: '',
			isOpen: false,
		}
	},

    methods: {
		 
        setIconWhite () {
          this.iconColor = 'text-white'
        },

        setIconBlack () {
          this.iconColor = 'text-black'
        },

        selectColor (color, variant) {
			this.currentColor = color + '-' + variant
			if (variant < 500) {
				this.setIconBlack()
			}
			else {
				this.setIconWhite()
			}
			this.$emit('color',this.currentColor)
        },

		toggle()
		{
    		this.isOpen = !this.isOpen
		},

		show() {
    		this.isOpen = true
    	},

		hide() { 
			this.isOpen = false
		},

		onClickAway (event, el){
			
			if(event.target.id==='svg')
			{
				this.show()
			} else {
				this.hide()
			}
		}
		
	},
	 
	directives : {

		clickOutside : {
			beforeMount(el, binding, vnode) {
				el.clickOutsideEvent = function(event) {
				if (!(el === event.target || el.contains(event.target))) {
					binding.value(event, el);
				}
				};
				document.body.addEventListener('click', el.clickOutsideEvent);
			},
			unmounted(el) {
				document.body.removeEventListener('click', el.clickOutsideEvent);
			}
		}
	}
})
</script>

<style>
    
</style>