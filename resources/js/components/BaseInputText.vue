<template>
  <input
    dusk="add-todo-input"
    type="text"
    class="input"
    :value="value"
    v-on="listeners"
  >
</template>

<script>
export default {
  props: {
    value: {
      type: String,
      default: '',
    }
  },
  computed: {
    listeners () {
      return {
        ...this.$listeners,
        input: event => this.$emit('input', event.target.value)
      }
    }
  }
}
</script>

<style lang="scss" scoped>
.input {
  width: 100%;
  padding: 8px 10px;
  border: 1px solid;
}
</style>
