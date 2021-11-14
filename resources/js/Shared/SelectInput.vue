<template>
  <div>
    <label v-if="label" class="block text-sm font-medium text-gray-700" :for="id">{{ label }}:</label>
    <select :id="id" ref="input" v-model="selected" v-bind="$attrs" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" :class="{ error: error }">
      <slot />
    </select>
    <div v-if="error" class="text-red-700 mt-2 text-sm">{{ error }}</div>
  </div>
</template>

<script>
export default {
  inheritAttrs: false,
  props: {
    id: {
      type: String,
      default() {
        return `select-input-${Math.random().toString(36).replace(/[^a-z]+/g, '').substr(0, 5)}`
      },
    },
    value: [String, Number, Boolean],
    label: String,
    error: String,
  },
  data() {
    return {
      selected: this.value,
    }
  },
  watch: {
    selected(selected) {
      this.$emit('input', selected)
    },
  },
  methods: {
    focus() {
      this.$refs.input.focus()
    },
    select() {
      this.$refs.input.select()
    },
  },
}
</script>
