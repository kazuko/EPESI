var SessionKeeper = {
    func: function(pe) {
        jQuery.post('modules/Tools/SessionKeeper/sk.php');
        SessionKeeper.time-=SessionKeeper.interval;
        if(SessionKeeper.time<=0) {
            clearInterval(SessionKeeper.id);
            jQuery.post('modules/Tools/SessionKeeper/logout.php',function(){
                document.location = 'index.php';
            });
        }
    },
    interval: 10000,
    time: null,
    maxtime: null,
    id: null,
    load: function() {
        if(SessionKeeper.maxtime==null) return;
        SessionKeeper.time = SessionKeeper.maxtime;
        if(SessionKeeper.id!=null) clearInterval(SessionKeeper.id);
        SessionKeeper.id = setInterval(SessionKeeper.func,SessionKeeper.interval);
    }
};
jQuery(document).on("e:load", function() {
    SessionKeeper.load();
});
