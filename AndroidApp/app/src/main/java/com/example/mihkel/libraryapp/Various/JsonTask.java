package com.example.mihkel.libraryapp.Various;

import android.app.ProgressDialog;
import android.content.Context;
import android.os.AsyncTask;
import android.util.Log;

import com.example.mihkel.libraryapp.Interfaces.ParseStringCallBackListener;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URL;

public class JsonTask extends AsyncTask<String, String, String> {

    public static final int TASK_TYPE_AUTHOR_AUTOCOMPLETE = 0;
    public static final int TASK_TYPE_GENRE_AUTOCOMPLETE = 1;
    public static final int TASK_TYPE_KEYWORD_AUTOCOMPLETE = 2;
    public static final int TASK_TYPE_RESULTS = 3;

    ParseStringCallBackListener mListener;
    Context context;
    ProgressDialog pd;
    Integer mType;
    String mText;


    public JsonTask(Context context, int type) {
        this.context = context;
        mType = type;
        switch (type) {
//            case TASK_TYPE_AUTHOR_AUTOCOMPLETE:
//                mText = "Palun oota";
//                break;
            default:
                mText = "Palun oota, andmeid laetakse";
                break;
        }
    }

    public JsonTask(Context context) {
        this.context = context;
        mText = "Palun oota, andmeid laetakse";
    }

    public JsonTask setListener(ParseStringCallBackListener listener) {
        mListener = listener;
        return this;
    }

    protected void onPreExecute() {
        super.onPreExecute();

        pd = new ProgressDialog(context);
        pd.setMessage(mText);
        pd.setCancelable(false);
        pd.show();
    }

    protected String doInBackground(String... params) {

        HttpURLConnection connection = null;
        BufferedReader reader = null;

        try {
            URL url = new URL(params[0]);
            connection = (HttpURLConnection) url.openConnection();
            connection.connect();
            InputStream stream = connection.getInputStream();

            reader = new BufferedReader(new InputStreamReader(stream));

            StringBuffer buffer = new StringBuffer();
            String line = "";

            while ((line = reader.readLine()) != null) {
                buffer.append(line + "\n");
                Log.d("Response: ", "> " + line);   //here u ll get whole response...... :-)
//                setResult(line);
            }
            return buffer.toString();
        } catch (MalformedURLException e) {
            e.printStackTrace();
        } catch (IOException e) {
            e.printStackTrace();
        } finally {
            if (connection != null) {
                connection.disconnect();
            }
            try {
                if (reader != null) {
                    reader.close();
                }
            } catch (IOException e) {
                e.printStackTrace();
            }
        }
        return null;
    }

//    private void setResult(String jsonString) {
////        Object x = new Gson().fromJson(line, new TypeToken<HashMap<Integer, String>>(){}.getType());
//        HashMap<Integer, String> map = new Gson().fromJson(jsonString, new TypeToken<HashMap<Integer, String>>() {
//        }.getType());
//        AppManagerSingleton.getInstance().setDataAtKey(AppManagerSingleton.SCHOOLS_DATA_KEY, map);
//        //AppManagerSingleton.getInstance().setDataAtKey(AppManagerSingleton.SCHOOLS_DATA_KEY);
//    }

    @Override
    protected void onPostExecute(String result) {
        super.onPostExecute(result);
        if (pd.isShowing()) {
            pd.dismiss();
        }
        if (mListener != null) {
            if (mType == null)
                mListener.callback(result, null);
            else
                mListener.callback(result, mType);


//            /txtJson.setText(result);

        }
    }


}
