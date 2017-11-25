export const customize = {
    formats: [
        { val : 'default', name: 'Saturday 11th November 2017 05:43:46 AM' },
        { val : 'english', name: '11/11/2017 05:43:46' },
        { val : 'german', name: '11.11.2017 05:43:46' },
        { val : 'english12', name: '11/11/2017 05:43:46 AM' },
        { val : 'rfc1123', name: 'Sat, 11 Nov 2017 05:43:46 +0000' },
        { val : 'iso8601', name: '2017-11-11T05:43:46+00:00' },
        { val : 'long', name: '11. November 2017 05:43:46' },
        { val : 'locale', name: '%2017-11-11T05:43:46+00:00' }
    ],
    timezones: window.DT.listTimezone
}