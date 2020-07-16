!function (n, e) {
    "object" == typeof exports && "undefined" != typeof module ? module.exports = e() : "function" == typeof define && define.amd ? define(e) : ((n = n || self).__vee_validate_locale__am = n.__vee_validate_locale__am || {}, n.__vee_validate_locale__am.js = e())
}(this, function () {
    "use strict";
    var n, e = {
        name: "am", messages: {
            _default: function (n) {
                return  n + "դաշտի արժեքը անթույլատրելի է"
            }, after: function (n, e) {
                var t = e[0];
                return n + "դաշտում պետք է պարունակի " + (e[1] +"օրվանից հետո " ? "կամ հավասար " : "") + t
            }, alpha: function (n) {
                return n + " դաշտը կարող է պարունակել միայն տառեր"
            }, alpha_dash: function (n) {
                return n + " դաշտը կարող է պարունակել միայն տառեր, թվեր ևдефис"
            }, alpha_num: function (n) {
                return n + " դաշտը կարող է պարունակել միայն տառեր և թվեր"
            }, alpha_spaces: function (n) {
                return n + " դաշտը կարող է պարունակել միայն տառեր և բացատներ"
            }, before: function (n, e) {
                var t = e[0];
                return n + " դաշտում պետք է պարունակի օրվանից " + (e[1] ? "կամ հավասար " : "") + t
            }, between: function (n, e) {
                return n + " դաշտը պետք է պարունակի "+ e[0] + " և " + e[1] + "միջև"
            }, confirmed: function (n, e) {
                return n + " դաշտը չի համապատասխանում դաշտին " + e[0]
            }, credit_card: function (n) {
                return n + " դաշտը պետք է պարունակի վավեր քարտի համար"
            }, date_between: function (n, e) {
                return n + " դաշտը պետք է պարունակի "+ e[0] + " և " + e[1] + "միջև"
            }, date_format: function (n, e) {
                return n + " դաշտը պետք է պարունակի ձևաչափով " + e[0]
            }, decimal: function (n, e) {
                void 0 === e && (e = []);
                var t = e[0];
                return void 0 === t && (t = "*"), n + " դաշտը պետք է պարունակի թվային և կարող է պարունակել" + ("*" === t ? " տասնորդական թվեր" : " " + t + " տասնորդական թվեր")
            }, digits: function (n, e) {
                return n + " դաշտը պետք է պարունակի թվային և ճշգրիտ պարունակի " + e[0] + " թվեր"
            }, dimensions: function (n, e) {
                return n + " դաշտը պետք է պարունակի " + e[0] + " փիքսել ըստ " + e[1] + " փիքսելից"
            }, email: function (n) {
                return n + " դաշտը պետք է պարունակի գործող էլ. փոստի հասցե"
            }, excluded: function (n) {
                return n + " դաշտը պետք է պարունակի ընդունելի արժեք"
            }, ext: function (n, e) {
                return n + " դաշտը պետք է պարունակի վավեր ֆայլ (" + e[0] + ")"
            }, image: function (n) {
                return n + " դաշտը պետք է պարունակի изображением"
            }, included: function (n) {
                return n + " դաշտը պետք է պարունակի ընդունելի արժեք"
            }, integer: function (n) {
                return n + " դաշտը պետք է պարունակի ամբողջ թիվ"
            }, ip: function (n) {
                return n + " դաշտը պետք է պարունակի վավեր IP հասցե"
            }, length: function (n, e) {
                var t = e[0], r = e[1];
                return r ? " Դաշտի երկարությունը " + n + " պետք է պարունակի " + t + " և " + r +"ի միջև " : "Դաշտի երկարությունը " + n + " պետք է պարունակի " + t
            }, max: function (n, e) {
                return n + " դաշտը չի կարող լինել ավելի " + e[0] + " նիշից"
            }, max_value: function (n, e) {
                return n + " դաշտը պետք է պարունակի " + e[0] + " կամ պակաս"
            }, mimes: function (n, e) {
                return n + " դաշտը պետք է ունենա վավեր ֆայլի տիպ (" + e[0] + ")"
            }, min: function (n, e) {
                return n + " դաշտը պետք է պարունակի ոչ պակաս " + e[0] + " նիշից"
            }, min_value: function (n, e) {
                return n + " դաշտը պետք է պարունակի " + e[0] + " կամ ավելի"
            }, numeric: function (n) {
                return n + " դաշտը պետք է պարունակի թվային"
            }, regex: function (n) {
                return n + " դաշտը ունի սխալ ձևաչափ"
            }, required: function (n) {
                return n + "դաշտը պարտադիր է"
            }, size: function (n, e) {
                return n + " դաշտը պետք է պարունակի քիչ, քան " + function (n) {
                    var e = 1024, t = 0 === (n = Number(n) * e) ? 0 : Math.floor(Math.log(n) / Math.log(e));
                    return 1 * (n / Math.pow(e, t)).toFixed(2) + " " + ["Բայթ", "ԿԲ", "ՄԲ", "ԳԲ", "ՏԲ", "ՊԲ", "ԷԲ", "ԶԲ", "ԻԲ"][t]
                }(e[0])
            }, url: function (n) {
                return n + " դաշտը ունի URL-ի անվավեր ձևաչափ"
            }
        }, attributes: {}
    };
    return "undefined" != typeof VeeValidate && VeeValidate.Validator.localize(((n = {})[e.name] = e, n)), e
});