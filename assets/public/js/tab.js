function initTabs(selector='[data-tabs--blocks]'){
  document.querySelectorAll(selector).forEach(tabs=>{
    const nav = tabs.querySelector('.orivo-tabs--blocks__nav');
    const indicator = tabs.querySelector('.orivo-tabs--blocks__indicator');
    const btns = tabs.querySelectorAll('.orivo-tabs--blocks__tab');
    const panels = tabs.querySelectorAll('.orivo-tabs--blocks__panel');

    function moveIndicator(btn){
      const r = btn.getBoundingClientRect();
      const n = nav.getBoundingClientRect();
      indicator.style.width = r.width + 'px';
      indicator.style.height = r.height + 'px';
      indicator.style.transform = `translate(${r.left-n.left}px,${r.top-n.top}px)`;
    }

    btns.forEach(btn=>{
      btn.onclick = ()=>{
        btns.forEach(b=>b.classList.remove('is-active'));
        panels.forEach(p=>p.classList.remove('is-active'));

        btn.classList.add('is-active');
        const panel = tabs.querySelector('#'+btn.dataset.tab);
        if(panel) panel.classList.add('is-active');

        moveIndicator(btn);
      };

      // Set indicator on load
      if(btn.classList.contains('is-active')) moveIndicator(btn);
    });

    tabs.refreshTabs = ()=>{
      btns.forEach(btn=>{
        if(btn.classList.contains('is-active')) moveIndicator(btn);
      });
    };
  });
}

initTabs();
