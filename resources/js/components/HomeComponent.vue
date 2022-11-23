<template>
    <div class="container">
        <div class="row justify-content-center">
            <p> Breakdowns</p>   
            <p class="break-downs" > </p>
        </div>
        <br />
        <div class="row justify-content-center">
            <p> Random Names</p>
            <p class = "rand-names"> </p>
        </div>
    </div>
</template>

<script>
    export default {
        props:[
            'data'
        ],
        data() {
            return{
                randomNames: [],
                breakDowns:[],

            }
        },
        methods: {
            BreakDown: function() {
                this.data.forEach(element => {
                    this.randomNames.push(element.values)
                    element.breakdowns.forEach(data => {
                        this.breakDowns.push(data.values)
                    })
                })
            },
            HtmlTags: function () {
                var brk = document.querySelector('.break-downs');
                brk.innerText = this.breakDowns;

                var rnd_names = document.querySelector('.rand-names')
                rnd_names.innerText = this.randomNames;
            },
            SpiralText: function(options = { target: undefined, span: 100, north: 0, spiral: false }) {
                const { target, span, north, spiral, size } = options;
                const message = target.textContent;
                const quaterWidth = target.clientWidth / 2;
                const diameter = size || quaterWidth;
                const messageChunks = message.split(String());
                const { length } = messageChunks;
                const offsetEnd = 1;
                const l = length + offsetEnd;
                const CIRC_MAX = 360;
                const PERC_MAX = 100;
                const ofDeg = span * CIRC_MAX / PERC_MAX;
                const ofNorth = north * CIRC_MAX / PERC_MAX;
                const segDeg = ofDeg / l;
                const fontSize = 16;
                let a = 0;
                let i = 0;
                
                target.setAttribute('style', `
                    padding-left: ${diameter / 2}px;
                    display: inline-block;
                    width: ${diameter / 2}px;
                    height: ${diameter / 4}px;
                    transform: rotate3d(0, 0, 1, -${segDeg + ofNorth}deg);
                    border-radius: 9e9em;
                    font-size: 1rem;
                `);
                target.textContent = '';
                    while (a < ofDeg) {
                        a += segDeg;
                        const charWrapper = document.createElement('span');
                        charWrapper.textContent = messageChunks[i] || charWrapper.innerText || "";
                        i ++;
                        charWrapper.classList.add('fx-RevolveCharWrap');
                        charWrapper.setAttribute('style', `
                        display: inline-block;
                        transform: 
                            rotate3d(0, 0, 1, ${a}deg) 
                            ${spiral ? 'translateY(' + (i) + 'px)': ''};
                        ${spiral ? 'font-size:' + (fontSize - (i / 5) ) + 'px': ''};
                        position: absolute;
                        height: ${diameter / 4}px;
                        transform-origin: bottom left;
                        font-size: 1em;
                        `);
                        target.appendChild(charWrapper);
                    }


            }

        },
        
        mounted() {

            this.BreakDown();
            this.HtmlTags();

            //Spiral text for Breakdowns
            this.SpiralText({
                target: document.querySelector('.break-downs'),
                span: this.breakDowns.length < 10? 200 :(this.breakDowns.length * 15 / 2 ),
                north: 0, 
                spiral: true,
                size:  this.breakDowns.length < 10? 400 :(this.breakDowns.length * 35)
            });

            //Spiral text for random names
            this.SpiralText({
                target: document.querySelector('.rand-names'),
                span: this.randomNames.length < 10? 100 :(this.randomNames.length * 40 / 2 ),
                north: 0,
                spiral: true,
                size:  this.randomNames.length < 10? 500 :(this.randomNames.length *  50)
            });

        }
    }
</script>
