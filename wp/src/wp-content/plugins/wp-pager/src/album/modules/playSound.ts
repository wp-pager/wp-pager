export default (fileName: string): void => {
    const sound = new Audio(`${pager.rootUrl}/assets/sounds/${fileName}.mp3`)
    sound.volume = 0.5
    sound.play()
}