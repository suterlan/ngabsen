/* Sidebar - Side navigation menu on mobile/responsive mode */
export default () => ({
    open: false,
  
    toggleSideMenu() {
        this.open = ! this.open
    },

    closeSideMenu(){
        this.open = false
    }
})