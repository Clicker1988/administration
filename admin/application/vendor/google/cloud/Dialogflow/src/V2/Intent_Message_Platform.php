<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/cloud/dialogflow/v2/intent.proto

namespace Google\Cloud\Dialogflow\V2;

/**
 * Represents different platforms that a rich message can be intended for.
 *
 * Protobuf enum <code>Google\Cloud\Dialogflow\V2\Intent\Message\Platform</code>
 */
class Intent_Message_Platform
{
    /**
     * Not specified.
     *
     * Generated from protobuf enum <code>PLATFORM_UNSPECIFIED = 0;</code>
     */
    const PLATFORM_UNSPECIFIED = 0;
    /**
     * Facebook.
     *
     * Generated from protobuf enum <code>FACEBOOK = 1;</code>
     */
    const FACEBOOK = 1;
    /**
     * Slack.
     *
     * Generated from protobuf enum <code>SLACK = 2;</code>
     */
    const SLACK = 2;
    /**
     * Telegram.
     *
     * Generated from protobuf enum <code>TELEGRAM = 3;</code>
     */
    const TELEGRAM = 3;
    /**
     * Kik.
     *
     * Generated from protobuf enum <code>KIK = 4;</code>
     */
    const KIK = 4;
    /**
     * Skype.
     *
     * Generated from protobuf enum <code>SKYPE = 5;</code>
     */
    const SKYPE = 5;
    /**
     * Line.
     *
     * Generated from protobuf enum <code>LINE = 6;</code>
     */
    const LINE = 6;
    /**
     * Viber.
     *
     * Generated from protobuf enum <code>VIBER = 7;</code>
     */
    const VIBER = 7;
    /**
     * Actions on Google.
     * When using Actions on Google, you can choose one of the specific
     * Intent.Message types that mention support for Actions on Google,
     * or you can use the advanced Intent.Message.payload field.
     * The payload field provides access to AoG features not available in the
     * specific message types.
     * If using the Intent.Message.payload field, it should have a structure
     * similar to the JSON message shown here. For more information, see
     * [Actions on Google Webhook
     * Format](https://developers.google.com/actions/dialogflow/webhook)
     * <pre>{
     *   "expectUserResponse": true,
     *   "isSsml": false,
     *   "noInputPrompts": [],
     *   "richResponse": {
     *     "items": [
     *       {
     *         "simpleResponse": {
     *           "displayText": "hi",
     *           "textToSpeech": "hello"
     *         }
     *       }
     *     ],
     *     "suggestions": [
     *       {
     *         "title": "Say this"
     *       },
     *       {
     *         "title": "or this"
     *       }
     *     ]
     *   },
     *   "systemIntent": {
     *     "data": {
     *       "&#64;type": "type.googleapis.com/google.actions.v2.OptionValueSpec",
     *       "listSelect": {
     *         "items": [
     *           {
     *             "optionInfo": {
     *               "key": "key1",
     *               "synonyms": [
     *                 "key one"
     *               ]
     *             },
     *             "title": "must not be empty, but unique"
     *           },
     *           {
     *             "optionInfo": {
     *               "key": "key2",
     *               "synonyms": [
     *                 "key two"
     *               ]
     *             },
     *             "title": "must not be empty, but unique"
     *           }
     *         ]
     *       }
     *     },
     *     "intent": "actions.intent.OPTION"
     *   }
     * }</pre>
     *
     * Generated from protobuf enum <code>ACTIONS_ON_GOOGLE = 8;</code>
     */
    const ACTIONS_ON_GOOGLE = 8;
}

