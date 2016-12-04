package com.example.mihkel.libraryapp.Activities;

import android.app.Activity;
import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ListView;
import android.widget.Toast;

import com.example.mihkel.libraryapp.Various.AppManagerSingleton;
import com.example.mihkel.libraryapp.Various.DatabaseLayerImpl;
import com.example.mihkel.libraryapp.Various.DatabaseManagerSingleton;
import com.example.mihkel.libraryapp.Interfaces.ParseStringCallBackListener;
import com.example.mihkel.libraryapp.Item.Item;
import com.example.mihkel.libraryapp.Item.School;
import com.example.mihkel.libraryapp.Various.JsonTask;
import com.example.mihkel.libraryapp.Various.ListAdapter;
import com.example.mihkel.libraryapp.R;

import java.util.ArrayList;
import java.util.List;

public class SchoolsListActivity extends Activity implements ParseStringCallBackListener {
    ListView listView;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_mandatory_list);

        DatabaseLayerImpl databaseLayer = new DatabaseLayerImpl();

        listView = (ListView) findViewById(R.id.schoolsList);
        List<Item> list = new ArrayList<Item>(databaseLayer.getSchools().values());
        ListAdapter adapter = new ListAdapter(this, R.layout.table_row, list);

        // Assign adapter to ListView
        listView.setAdapter(adapter);

        // ListView Item Click Listener
        listView.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {

                // ListView Clicked item index
                int itemPosition = position;
                // ListView Clicked item value
                School itemValue = (School) listView.getItemAtPosition(position);

                // Show Alert
//                Toast.makeText(getApplicationContext(),
//                        "Position :" + itemPosition + "  ListItem : " + itemValue, Toast.LENGTH_LONG)
//                        .show();
                AppManagerSingleton.selectedSchoolId = itemValue.getId();

                if (true || !DatabaseManagerSingleton.getInstance().hasClassesInSchool(AppManagerSingleton.selectedSchoolId))
                    fetchDataFromServer(itemValue.getId());
                else
                    startNextActivity();
            }

        });
    }

    public void fetchDataFromServer(int schoolId) {
        JsonTask jsonTask = new JsonTask(SchoolsListActivity.this).setListener(this);
        jsonTask.execute("http://admin-mihkelvilismae.rhcloud.com/AdminInterface/json/Klassid/" + schoolId);
    }

    public void startNextActivity() {
        Intent calendarStartIntent = new Intent(this, ClassesListActivity.class);
        startActivity(calendarStartIntent);
    }

    @Override
    public void callback(String jsonString) {
        DatabaseManagerSingleton.getInstance().setClassesInSchoolJson(AppManagerSingleton.selectedSchoolId, jsonString);
        startNextActivity();
    }
}