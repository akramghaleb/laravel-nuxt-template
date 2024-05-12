
export const useCounter = defineStore('counter', {
  state: () => ({
    value: 0,
  }),

  actions: {
    increment() {
      this.value++;
    },

    decrement() {
        this.value--;
      },

    reset() {
        this.value= 0;
    },
  },

  persist: {
    storage: persistedState.localStorage,
  },
})

