function getColorLabel(length) {
    let color= [];
    let j = 0;
    let k = 80;
    for(let i = 0; i < length; i++) {
        color.push('rgb(75, ' + j + ',192)');
        if (j > 255) {
            j = 0;
        } else {
            j+=40;
        }
    }

    return color;
}
