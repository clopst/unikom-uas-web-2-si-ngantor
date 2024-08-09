const str = 'function(data) { console.log("ASD"); }';

const func = new Function("return " + str);
console.log({
    func,
});
console.log(func()());
