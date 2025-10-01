export default (): void => {
    window.addEventListener('scroll', (): void => {
<<<<<<< Updated upstream
        const anchorTop = document.getElementById('anchor-top');
        if (anchorTop) {
            if (window.scrollY > 300) {
                anchorTop.classList.remove('disabled');
            } else {
                anchorTop.classList.add('disabled');
            }
=======
        const anchorTop: HTMLDivElement = document.getElementById('anchor-top') as HTMLDivElement;
        if (window.scrollY > 300) {
            anchorTop.classList.remove('disabled');
        } else {
            anchorTop.classList.add('disabled');
>>>>>>> Stashed changes
        }
    });
};
