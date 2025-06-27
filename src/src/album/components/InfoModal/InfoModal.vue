<script setup lang="ts">
import CloseIcon from '@shared/components/Icons/CloseIcon.vue'
import isTouchDevice from 'is-touch-device'

type Emits = {
    (e: 'closed'): void
}

const emit = defineEmits<Emits>()
</script>

<template>
    <div data-v-amp206>
        <h2>Keyboard shortcuts</h2>

        <ul>
            <li><kbd>►</kbd> <span>go to the next image</span></li>
            <li><kbd>◄</kbd> <span>go to the previous image</span></li>
            <li><kbd>d</kbd> <span>download the current image</span></li>
        </ul>

        <button
            v-if="isTouchDevice()"
            @click="emit('closed')"
            type="button"
            class="pager-close"
        >
            <CloseIcon class="pager-icon" />
        </button>
    </div>
</template>

<style lang="scss" scoped>
[data-v-amp206] {
    position: absolute;
    background-color: white;
    padding: 1rem;
    bottom: calc(100% + 5px);
    width: 280px;
    border-radius: 9px;
    box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0.2);
    z-index: 12;

    button.pager-close {
        position: absolute;
        top: 10px;
        right: 10px;
        background-color: transparent;
        border: none;
        cursor: pointer;
        padding: 7px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;

        &:hover {
            background-color: #eee;
        }
        .pager-icon {
            width: 20px;
            height: 20px;
        }
    }
    h2 {
        font-size: 1.2rem;
        font-weight: 500;
        margin-bottom: 1rem;
        margin-top: 0;
    }
    ul {
        list-style: none;
        margin: 0;
        padding-left: 15px;

        li {
            kbd {
                display: inline-block;
                padding: 0.3rem 0.5rem;
                min-width: 17px;
                text-align: center;
                line-height: 1;
                color: #444;
                vertical-align: middle;
                background-color: #f9f9f9;
                border-radius: 3px;
                border: 1px solid #c6cbd1;
                box-shadow: inset 0 -1px 0 rgba(0, 0, 0, 0.25);
                text-shadow: 0 1px 0 rgba(255, 255, 255, 0.5);
                font-family: sans-serif;
                font-size: 0.8rem;
            }
            span {
                margin-left: 6px;
                color: #555;
                font-size: 0.9rem;
            }
        }
    }
}
</style>
